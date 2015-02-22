var appApp = angular.module('appApp', []);

appApp.controller("FacturaController", ['$http', '$scope', function($http, $scope) {
    $scope.conceptos = [];
    $http.get(apiurlconceptos).success(function(data){
        $scope.conceptos = data;
    });
}]);

appApp.controller("ConceptoFormController", ['$http', '$scope', function($http, $scope) {

    $scope.addConcepto = function() {
        var total = $scope.concepto.cantidad * $scope.concepto.precio;
        var totaliva = total/100*$scope.concepto.iva;

        var values = {
            nombre: $scope.concepto.nombre,
            cantidad: $scope.concepto.cantidad,
            precio: $scope.concepto.precio,
            iva: $scope.concepto.iva,
            total: total,
            totaliva: totaliva,
            facturaid: factura_id
        };
        $scope.conceptos.push(values);

        $scope.concepto.nombre = "";
        $scope.concepto.precio = "";
        $scope.concepto.cantidad = "";
        $scope.concepto.iva = "";
        $scope.concepto.total = "";
        $scope.concepto.totaliva = "";

        $http.post(apiurlconceptopost, values).success(function(data, status, headers, config) {
            console.log(data);
        });
    };
}]);


