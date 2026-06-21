import HSStaticMethods from "preline";

class DynamicFields {
    constructor(options) {
        this.wrapper = document.querySelector(options.wrapper);
        this.addButton = document.querySelector(options.addButton);
        this.template = document.querySelector(options.template);

        this.rowSelector = options.rowSelector || '.js-dynamic-row';
        this.removeSelector = options.removeSelector || '.js-dynamic-remove';

        this.index = options.startIndex ?? this.wrapper?.children.length ?? 0;

        if (!this.wrapper || !this.addButton || !this.template) {
            return;
        }

        this.bindEvents();
    }

    bindEvents() {
        this.addButton.addEventListener('click', () => {
            this.addRow();
        });

        this.wrapper.addEventListener('click', (event) => {
            const removeButton = event.target.closest(this.removeSelector);

            if (!removeButton) {
                return;
            }

            const row = removeButton.closest(this.rowSelector);

            if (row) {
                row.remove();
            }
        });
    }

    addRow() {
        const html = this.template.innerHTML.replaceAll('__INDEX__', this.index);

        const temp = document.createElement('div');
        temp.innerHTML = html.trim();

        const row = temp.firstElementChild;

        this.wrapper.appendChild(row);

        HSStaticMethods.autoInit();

        this.index++;
    }
}



window.DynamicFields = DynamicFields;
