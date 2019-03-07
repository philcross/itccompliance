<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>title</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:400" rel="stylesheet">

        <style type="text/css">
            html, body {
                background-color: #eeeeee;
                font-family: 'Roboto', sans-serif;
                font-size: 12px;
            }

            .container {
                width: 80%;
                margin-left: auto;
                margin-right: auto;
            }

            .card {
                background-color: #ffffff;
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;
            }

            .card .header {
                background-color: #716aca;
                padding: 15px;
            }

            .card .header h1 {
                margin: 0px;
                padding: 0px;
                color: #efeeff;
            }

            .card .body {
                padding: 15px;
            }

            table.product-table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
                border-collapse: collapse;
            }

            table.product-details-table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
                border-collapse: collapse;
            }

            table.loading {
                display: none;
            }

            table.product-table thead tr th {
                border-top: 0;
                border-bottom: 1px solid #5867dd;
                vertical-align: bottom;
                padding: .75rem;
            }

            table.product-details-table tr th {
                border-top: 0;
                border-right: 1px solid #5867dd;
                border-top: 1px solid #f4f5f8;
                background-color: #eeeeee;
                vertical-align: middle;
                padding: .75rem;
                text-align: right;
                width: 25%;
            }

            table.product-table tbody td {
                padding: .75rem;
                border-top: 1px solid #f4f5f8;
                vertical-align: middle;
            }

            table.product-details-table tbody td {
                padding: .75rem;
                vertical-align: middle;
                border-top: 1px solid #f4f5f8;
                text-align: left;
            }

            div.loader {
                width: 100%;
                text-align: center;
            }

            div.loader.loaded {
                display: none;
            }

            a {
                color: #716aca;
                text-decoration: none;
                position: relative;
                display: inline-block;
            }

            a:hover {
                color: #5f57c3;
                border-bottom: 1px solid #5f57c3;
                margin-bottom: -1px;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }

            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="header">
                    <h1>Products Available</h1>
                </div>
                <div class="body">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="loader">
                        <img src="/assets/loader.gif">
                    </div>
                </div>
            </div>
        </div>

        <div id="product_modal" class="modal">
            <div class="modal-content">
                <a href="javascript:app.closeModal();" class="close">&times;</a>
                <table class="product-details-table">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td rel="id"></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td rel="name"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td rel="description"></td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td rel="type"></td>
                        </tr>
                        <tr>
                            <th>Suppliers</th>
                            <td rel="suppliers"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <script type="text/javascript">
            var app = (function App(){
                var products = [];

                return {
                    loadProducts: function () {
                        var request = new XMLHttpRequest;

                        request.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                app.renderProducts(JSON.parse(this.responseText));
                            }
                        };

                        request.open('GET', 'products.php', true);
                        request.send();
                    },

                    renderProducts: function (products) {
                        this.products = products;

                        document.querySelector('table').classList.remove('loading');
                        document.querySelector('.loader').classList.add('loaded');

                        var productTable = document.querySelector('table tbody');
                        var productLink, linkText, row, cell, text;

                        for (i in products) {
                            row = productTable.insertRow(productTable.rows.length);

                            cell = row.insertCell(0);
                            text = document.createTextNode(products[i]['name']);
                            productLink = document.createElement('a');
                            linkText = document.createTextNode(products[i]['name']);
                            productLink.appendChild(linkText);
                            productLink.href = "javascript:app.openModal('" + i + "');";
                            cell.appendChild(productLink);

                            cell = row.insertCell(1);
                            text = document.createTextNode(products[i]['description']);
                            cell.appendChild(text);
                        }
                    },

                    getModal: function () {
                        return  document.getElementById('product_modal');
                    },

                    openModal: function (id) {
                        app.getModal().style.display = "block";

                        console.log(this.products, id);

                        idNode = document.createTextNode(this.products[id]['id']);
                        document.querySelector('.product-details-table [rel="id"]').appendChild(idNode);

                        nameNode = document.createTextNode(this.products[id]['name']);
                        document.querySelector('.product-details-table [rel="name"]').appendChild(nameNode);

                        descriptionNode = document.createTextNode(this.products[id]['description']);
                        document.querySelector('.product-details-table [rel="description"]').appendChild(descriptionNode);

                        typeNode = document.createTextNode(this.products[id]['type']);
                        document.querySelector('.product-details-table [rel="type"]').appendChild(typeNode);

                        supplierUlNode = document.createElement('ul');

                        for (x in this.products[id]['suppliers']) {
                            supplierLiNode = document.createElement('li');
                            supplierTextNode = document.createTextNode(this.products[id]['suppliers'][x]);
                            supplierLiNode.appendChild(supplierTextNode);
                            supplierUlNode.appendChild(supplierLiNode);
                        }

                        document.querySelector('.product-details-table [rel="suppliers"]').appendChild(supplierUlNode);
                    },

                    closeModal: function () {
                        app.getModal().style.display = "none";
                    }
                }
            })();

            app.loadProducts();

            window.onclick = function(event) {
                console.log(event.target, app.getModal());
                if (event.target == app.getModal()) {
                    app.getModal().style.display = "none";
                }
            }
        </script>
    </body>
</html>
