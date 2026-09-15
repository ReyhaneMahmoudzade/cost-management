<?php

namespace Tests\Feature;

use App\Models\Part;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Tests\TestCase;

class PartImportTest extends TestCase
{
    use RefreshDatabase;
    private function makeExcel(array $rows): string
    {
        $path = sys_get_temp_dir() . '/parts-feature-' . uniqid() . '.xlsx';
        $ss = new Spreadsheet();
        $ss->getActiveSheet()->fromArray($rows, null, 'A1');
        (new Xlsx($ss))->save($path);

        return $path;
    }

    public function test_import_form_is_accessible(): void
    {
        $this->get(route('parts.importForm'))->assertStatus(200);
    }

    public function test_template_downloads(): void
    {
        $this->get(route('parts.importTemplate'))
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

    public function test_import_creates_parts_and_skips_duplicates(): void
    {
        Part::whereIn('code', ['FT-001', 'FT-002'])->delete();

        $path = $this->makeExcel([
            ['نام قطعه *', 'کد قطعه *', 'گروه کالا', 'ماهیت', 'وزن (گرم)', 'مساحت', 'محیط', 'سایر اطلاعات'],
            ['قطعه یک', 'FT-001', 'محفظه و متعلقات', '', '۱۲۰۰', '10', '5', ''],
            ['قطعه دو', 'FT-002', '', '', '', '', '', ''],
            ['بدون کد', '', '', '', '', '', '', ''],
        ]);

        $response = $this->post(route('parts.importStore'), [
            'file' => new UploadedFile($path, 'parts.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null, true),
        ]);

        $response->assertRedirect(route('parts.importForm'));
        $this->assertDatabaseHas('parts', ['code' => 'FT-001', 'name' => 'قطعه یک']);
        $this->assertDatabaseHas('parts', ['code' => 'FT-002']);
        $this->assertEquals(1200, (float) Part::where('code', 'FT-001')->first()->weight);

        // آپلود مجدد → هر دو باید skip شوند
        $response2 = $this->post(route('parts.importStore'), [
            'file' => new UploadedFile($path, 'parts.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null, true),
        ]);
        $response2->assertRedirect(route('parts.importForm'));
        $this->assertEquals(1, Part::where('code', 'FT-001')->count());

        // ویرایش قطعه ایمپورتی باز می‌شود (برای تکمیل مواد/فرآیند)
        $part = Part::where('code', 'FT-002')->first();
        $this->get(route('parts.edit', $part))->assertStatus(200);

        Part::whereIn('code', ['FT-001', 'FT-002'])->delete();
        @unlink($path);
    }

    public function test_import_rejects_invalid_file(): void
    {
        $response = $this->post(route('parts.importStore'), [
            'file' => UploadedFile::fake()->create('evil.txt', 10, 'text/plain'),
        ]);
        $response->assertSessionHasErrors('file');
    }
}
