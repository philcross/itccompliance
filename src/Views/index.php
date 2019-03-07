<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>title</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:400" rel="stylesheet">
        <link href="/assets/style.css" rel="stylesheet">
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

        <script type="text/javascript" src="/assets/scripts.js"></script>
    </body>
</html>
