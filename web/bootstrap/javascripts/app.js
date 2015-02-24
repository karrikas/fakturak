var appApp = angular.module('appApp', []);

appApp.controller("FacturaController", ['$http', '$scope', function($http, $scope) {
    $scope.conceptos = [];
    $http.get(apiurlconceptos).success(function(data){
        $scope.conceptos = data;
        $scope.totales();
    });

    $scope.factura.total = 0;
    $scope.factura.totaliva = 0;

    $scope.totales = function() {
        $scope.factura.total = 0;
        $scope.factura.totaliva = 0;

        angular.forEach($scope.conceptos, function(value, key) {
            $scope.factura.total = $scope.factura.total + parseFloat(value.total);
            $scope.factura.totaliva = $scope.factura.totaliva + parseFloat(value.totaliva);
        });
    };

    $scope.removeConcepto = function (concepto_id) {
        angular.forEach($scope.conceptos, function(value, key) {
            if (value.id == concepto_id) {
                $scope.conceptos.splice(key, 1);
            }
        });
        $scope.totales();
        $http.delete(apiurlconcepto + '/' + concepto_id).success(function(data, status, headers, config) {});
    };

    $scope.mainFormSubmit = function($event) {
        /*
        $event.preventDefault();
        return false;
        */
    };
}]);

appApp.controller("ConceptoFormController", ['$http', '$scope', function($http, $scope) {

    $scope.addConcepto = function() {
        if($scope.FormConcepto.$invalid) {
            console.log("form mal");
            if (!$("#concepto").hasClass("ng-valid")) {
                $("#concepto").addClass("ng-invalid ng-touched");
            }
            if (!$("#precio").hasClass("ng-valid")) {
                $("#precio").addClass("ng-invalid ng-touched");
            }
            if (!$("#cantidad").hasClass("ng-valid")) {
                $("#cantidad").addClass("ng-invalid ng-touched");
            }
            if (!$("#iva").hasClass("ng-valid")) {
                $("#iva").addClass("ng-invalid ng-touched");
            }
            return false;
        }

        var total = $scope.concepto.cantidad * $scope.concepto.precio;
        var totaliva = total + (total/100*$scope.concepto.iva);

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

        $scope.totales();

        $http.put(apiurlconcepto, values).success(function(data, status, headers, config) {});
    };
}]);

appApp.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });

                event.preventDefault();
            }
        });
    };
});
