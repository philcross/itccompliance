var App = function (tableBuilder) {
    var products = [];

    var productTable = document.querySelector('.product-table');
    var productTableBody = document.querySelector('.product-table tbody');
    var loader = document.querySelector('.loader');

    var finishLoading = function () {
        productTable.classList.remove('loading');
        loader.classList.add('loaded');
    };

    var loadProducts = function () {
        var request = new XMLHttpRequest;
        var _this = this;

        request.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                _this.products = JSON.parse(this.responseText);
                _this.renderProducts();
            }
        };

        request.open('GET', 'products.php', true);
        request.send();
    };

    var renderProducts = function () {
        finishLoading();

        var i, row;

        for (i in this.products) {
            row = productTableBody.insertRow(productTableBody.rows.length);

            tableBuilder.createLinkCell(row, 0, this.products[i]['name'], 'javascript:app.openModal(\'' + i + '\');');
            tableBuilder.createTextCell(row, 1, this.products[i]['description']);
        }
    };

    var getModal = function () {
        return  document.getElementById('product_modal');
    };

    var openModal = function (id) {
        app.getModal().style.display = "block";

        tableBuilder.updateCellContent('.product-details-table [rel="id"]', this.products[id]['id'], 'Unknown');
        tableBuilder.updateCellContent('.product-details-table [rel="name"]', this.products[id]['name'], 'Unknown');
        tableBuilder.updateCellContent('.product-details-table [rel="description"]', this.products[id]['description'], 'Unknown');
        tableBuilder.updateCellContent('.product-details-table [rel="type"]', this.products[id]['type'], 'Unknown');
        tableBuilder.updateCellContentWithList('.product-details-table [rel="suppliers"]', this.products[id]['suppliers'], 'No known suppliers');
    };

    var closeModal = function () {
        app.getModal().style.display = "none";
    };

    var init = function () {
        this.loadProducts();

        window.onclick = function(event) {
            if (event.target === app.getModal()) {
                closeModal();
            }
        }
    };

    return {
        init: init,
        loadProducts: loadProducts,
        renderProducts: renderProducts,
        getModal: getModal,
        openModal: openModal,
        closeModal: closeModal
    }
};

var TableBuilder = function () {
    return {
        createTextCell: function (row, position, content) {
            var cell = row.insertCell(position);
            var text = document.createTextNode(content);
            cell.appendChild(text);
        },

        createLinkCell: function (row, position, text, url) {
            var cell = row.insertCell(0);
            var link = document.createElement('a');

            link.appendChild(document.createTextNode(text));
            link.href = url;

            cell.appendChild(link);
        },

        updateCellContent: function (selector, content, defaultContent) {
            var span;
            var node = document.querySelector(selector);

            node.innerHTML = '';

            if (!content) {
                span = document.createElement('span');
                span.setAttribute('class', 'unknown');
                span.appendChild(document.createTextNode(defaultContent));

                content = span;
            } else {
                content = document.createTextNode(content);
            }

            node.appendChild(content);
        },

        updateCellContentWithList: function (selector, content, defaultContent) {
            var x, span;
            var listNode = document.createElement('ul');

            if (!content || content.length === 0) {
                span = document.createElement('span');
                span.setAttribute('class', 'unknown');
                span.appendChild(document.createTextNode(defaultContent));

                content = span;
            } else {
                var listNode = document.createElement('ul');

                for (x in content) {
                    var itemNode = document.createElement('li');

                    itemNode.appendChild(document.createTextNode(content[x]));
                    listNode.appendChild(itemNode);
                }

                content = listNode;
            }

            var cell = document.querySelector(selector);

            cell.innerHTML = '';
            cell.appendChild(content);
        }
    }
};

var app = new App(new TableBuilder);
app.init();
