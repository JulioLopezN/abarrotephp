<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AbarrotePHP</title>
    <!-- Bootstrap CSS -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Kendo-ui-->
    <link href='/bower_components/kendo-ui/styles/kendo.common.min.css' rel='stylesheet'>
    <!-- Kendo-ui bootstrap-->
    <link href='/bower_components/kendo-ui/styles/kendo.bootstrap.min.css' rel='stylesheet'>
    <!-- Lightbox --> 
    <link href='/bower_components/lightbox2/dist/css/lightbox.min.css' rel='stylesheet'>

    <style>
        .k-input, .k-textbox, .k-numerictextbox, .k-dropdown {
            width: 100% !important;
        }

        #tableProductos tr td {
            cursor: pointer;
        }
    </style>
</head>
<body ng-app="abarrotePHP">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">AbarrotePHP</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="https://github.com/JulioLopezN/abarrotephp">Github</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section class="container" ng-controller="ControllerController">
        <h1>Productos</h1>
        <button class="btn btn-default pull-right" ng-click="newP()">Nuevo producto</button>
        <table id="tableProductos" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <th>Codigo</th>
                <th>Concepto</th>
                <th>Categoria</th>
                <th>Unidad</th>
                <th class="text-right">Precio</th>
                <th class="text-right">Costo</th>
                <th class="text-right">Cantidad</th>
            </thead>
            <tbody>
                <tr ng-repeat="p in productos" ng-click="edit(p)">
                    <td>{{p.codigo}}</td>
                    <td>{{p.concepto}}</td>
                    <td>
                        <select kendo-drop-down-list k-ng-model="p.categoria_id" k-value-primitive="true" k-options="options" name="categoria_id" readonly></select>
                    </td>
                    <td>{{p.unidad}}</td>
                    <td><span class="pull-left">$</span><span class="pull-right">{{p.precio}}</span></td>
                    <td><span class="pull-left">$</span><span class="pull-right">{{p.costo}}</span></td>
                    <td class="text-right">{{p.cantidad}}</td>
                </tr>
            </tbody>
        </table>

        <div id="modal-producto" class="modal fade">
            <div class="modal-dialog">
            <form id="form-producto" class="modal-content" action="/index.php/ProductosController/edit" method="POST" role="form" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">PRODUCTO</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <input type="text" class="hidden" name="id" ng-model="productoSelected.id">
                    <div class="form-group col-sm-6">
                        <label class="control-label">Codigo</label>
                        <input type="text" class="form-control k-textbox" ng-model="productoSelected.codigo" name="codigo" placeholder="Codigo" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Concepto</label>
                        <input type="text" class="form-control k-textbox" ng-model="productoSelected.concepto" name="concepto" placeholder="concepto" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Categoria</label>
                        <select kendo-drop-down-list k-ng-model="productoSelected.categoria_id" k-value-primitive="true" k-options="options" name="categoria_id" required>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Unidad</label>
                        <select kendo-drop-down-list k-ng-model="productoSelected.unidad" k-value-primitive="true" name="unidad" required>
                            <option value="Barra">Barra</option>
                            <option value="Bolsa">Bolsa</option>
                            <option value="Bulto">Bulto</option>
                            <option value="Caja">Caja</option>
                            <option value="Fardo">Fardo</option>
                            <option value="Kilogramo">Kilogramo</option>
                            <option value="Paquete">Paquete</option>
                            <option value="Pieza">Pieza</option>
                            <option value="Saco">Saco</option>
                            <option value="Tira">Tira</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Precio</label>
                        <input kendo-numeric-text-box k-min="0" k-ng-model="productoSelected.precio"  k-option="numericOptions" name="precio" required />
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Costo</label>
                        <input kendo-numeric-text-box k-min="0" k-ng-model="productoSelected.costo" name="costo" required />
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Cantidad</label>
                        <input kendo-numeric-text-box k-min="0" k-ng-model="productoSelected.cantidad" name="cantidad" required />
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label">Descripcion</label>
                        <textarea type="text" class="form-control k-textbox" ng-model="productoSelected.descripcion" name="descripcion" placeholder="Descripcion" required></textarea>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label">Imagen</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a href="/images/{{productoSelected.imagen_url}}" id="btn-image" class="btn btn-primary btn-sm" ng-class="productoSelected.imagen_url === undefined || productoSelected.imagen_url == null || productoSelected.imagen_url == '' ? 'disabled' : 'show'" data-lightbox="producto-imagen">Imagen actual</a>
                            </span>
                            <input type="text" class="input-file form-control k-textbox" placeholder="Nueva imagen" readonly>
                            <span class="input-group-btn">
                                <button type="button" class="btn-file btn btn-default" style="padding: 4px 12px;"><span class="glyphicon glyphicon-picture"></span></button>
                            </span>
                        </div>
                        <input type="file" class="hidden" accept="image/*" name="imagen"/>
                    </div>
                    <div class="col-sm-12">
                        <div class="alert hidden" role="alert"></div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" ng-click="deleteP(productoSelected.id)"><span class="glyphicon glyphicon-trash"></span></button>
                <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
                <button type="submit" class="btn btn-success">GUARDAR</button>
                </div>
            </form>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery Form-->
    <script src="/bower_components/jquery-form/jquery.form.js"></script>
    <!-- Bootstrap -->
    <script src="/bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <!-- Angularjs -->
    <script src="/bower_components/angular/angular.min.js"></script>
    <!-- Kendo-ui -->
    <script src="/bower_components/kendo-ui/js/kendo.core.min.js"></script>
    <script src="/bower_components/kendo-ui/js/kendo.angular.min.js"></script>
    <script src="/bower_components/kendo-ui/js/kendo.ui.core.min.js"></script>
    <script src="/bower_components/kendo-ui/js/cultures/kendo.culture.es-MX.min.js"></script>
    <!-- Lightbox --> 
    <script src="/bower_components/lightbox2/dist/js/lightbox.min.js"></script>
    <!-- App -->
    <script>
        $(function (){
            $('.btn-file').click(function (e) {
                e.preventDefault();
                if($('input[name=imagen]').val() == "")
                $('input[name=imagen]').click();
                else {
                $('input.input-file').val('');
                $('input[name=imagen]').val('');
                $('input[name=imagen]').change();
                }
            });

            $('input[name=imagen]').change(function (e) {
                var value = $('input[name=imagen]').val() != "" ? $('input[name=imagen]')[0].files[0].name : "";
                $('input.input-file').val(value);

                if(value != "") {
                    $('.btn-file').removeClass('btn-default');
                    $('.btn-file').addClass('btn-danger');
                    $('.btn-file .glyphicon').removeClass('glyphicon-picture');
                    $('.btn-file .glyphicon').addClass('glyphicon-remove-circle');
                } else {
                    $('.btn-file').addClass('btn-default');
                    $('.btn-file').removeClass('btn-danger');
                    $('.btn-file .glyphicon').addClass('glyphicon-picture');
                    $('.btn-file .glyphicon').removeClass('glyphicon-remove-circle');
                }
            });

            $('#form-producto').ajaxForm({
                dataType: 'json',
                success: function (data, type, response, target) { 
                    loadProductos();
                    $('#modal-producto').modal('hide');
                },
                error: function (response, error, data, target) {
                    alert('error');
                },
            });
        });
    </script>
    <script>
        var loadProductos = {};
        (function() {
            'use strict';
            angular
                .module('abarrotePHP', ["kendo.directives"])
                .filter('num', function() {
                    return function(input) {
                        return parseInt(input, 10);
                    };
                })
                .controller('ControllerController', ['$scope', '$http', ProductosController]);

            function ProductosController($scope, $http) {
                $scope.productos = [];
                $scope.categorias = [];
                $scope.productoSelected = {};
                loadProductos = function () {
                    $http.post('/index.php/ProductosController/all')
                        .then(function(response) {
                            $scope.productos = response.data;
                        }, 
                        function(response) { 
                            alert('Error');
                        });
                }
                loadProductos();
                $http.post('/index.php/CategoriasController/all')
                    .then(function(response) {
                        $scope.categorias = response.data;
                        $scope.options = {
                            dataSource: {data: response.data},
                            dataTextField: "descripcion",
                            dataValueField: "id"
                        };
                    }, 
                    function(response) { 
                        alert('Error');
                    });
                $scope.edit = function (producto) {
                    $('#form-producto').attr('action', '/index.php/ProductosController/edit');
                    $scope.productoSelected = producto;
                    $('#modal-producto').modal('show');
                }
                $scope.numericOptions = {
                    format: "c",
                    decimals: 2
                };
                $scope.newP = function () {
                    $('#form-producto').attr('action', '/index.php/ProductosController/add');
                    $scope.productoSelected = {};
                    $('#modal-producto').modal('show');
                }
                $scope.deleteP = function (idProducto) {
                    var conf = {headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}}
                    $http.post('/index.php/ProductosController/delete', $.param({id: idProducto}), conf)
                        .then(function(response) {
                            loadProductos();
                            $scope.productoSelected = {};
                            $('#modal-producto').modal('hide');
                        }, 
                        function(response) { 
                            alert('Error');
                        });
                }
            }
        })();
    </script>
</body>
</html>
