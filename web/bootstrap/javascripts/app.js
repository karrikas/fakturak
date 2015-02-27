var appApp = angular.module('appApp', []);

appApp.controller("FacturaController", ['$http', '$scope', function($http, $scope) {
    $scope.conceptos = [];
    $http.get(apiurlconceptos).success(function(data){
        $scope.conceptos = data;
        $scope.totales();
    });

    $scope.clientes = [];
    $http.get(apiurlclientes).success(function(data){
        $scope.clientes = data;
    });

    $("#clienteNuevo").hide();
    $scope.clienteNuevo = function() {
        $("#clienteSeleccionar").hide();
        $("#clienteNuevo").show();
    }

    $scope.clienteNuevoCancelar = function() {
        $("#clienteSeleccionar").show();
        $("#clienteNuevo").hide();
    }

    $scope.clienteNuevoSelect = function(cliente) {
        $scope.clientes.push(cliente);
        $scope.clienteSelect = cliente.id;
        $scope.clienteChange();
    }

    $scope.facturaUpdate = function() {
        $scope.factura.id = factura_id;
        $http.put(apiurlfactura, $scope.factura).success(function(data){});
    }

    $scope.clienteChange = function() {
        $http.get(apiurlcliente + "?id=" + $scope.factura.cliente).success(function(data){
            var info = "";
            info += data.nombre;
            info += '<br>';
            if (data.cif != null) {
                info += data.cif;
                info += '<br>';
            }
            if (data.direcion1 != null) {
                info += data.direccion1;
                info += '<br>';
            }
            if (data.direcion2 != null) {
                info += data.direccion2;
                info += '<br>';
            }
            if (data.ciudad != null) {
                info += data.ciudad;
                info += ', ';
            }
            if (data.region != null) {
                info += data.region;
                info += ', ';
            }
            if (data.cp != null) {
                info += data.cp;
                info += '<br>';
            }

            $scope.factura.clienteinfo = info;

            $scope.clienteInfoChange();
            $scope.facturaUpdate();
        });
    }

    $scope.clienteInfoChange = function() {
        var clienteinfo = $scope.factura.clienteinfo.replace(/<br>/g, '\r');
        $("#alz_appbundle_factura_clienteinfo").val(clienteinfo);
        $scope.facturaUpdate();
    }

    $scope.factura.total = 0;
    $scope.factura.totaliva = 0;

    $scope.totales = function() {
        $scope.factura.total = 0;
        $scope.factura.totaliva = 0;

        angular.forEach($scope.conceptos, function(value, key) {
            $scope.factura.total = $scope.factura.total + parseFloat(value.total);
            $scope.factura.totaliva = $scope.factura.totaliva + parseFloat(value.totaliva);
        });

        $scope.facturaUpdate();
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

    $scope.fechaChange = function() {
        var fecha = $scope.factura.fecha;
        $("#alz_appbundle_factura_fecha").val(fecha);

        $scope.facturaUpdate();
    }

    $scope.numeroChange = function() {
        var numero = $scope.factura.numero.replace(/[^0-9]/g, '');
        $scope.factura.numero = numero;
        $("#alz_appbundle_factura_numero").val(numero);

        $scope.facturaUpdate();
    }

    $scope.empresaChange = function() {
        var empresainfo = $scope.factura.empresainfo.replace(/<br>/g, '\r');
        $("#alz_appbundle_factura_empresainfo").val(empresainfo);

        $scope.facturaUpdate();
    }
}]);

appApp.controller("ClienteFormController", ['$http', '$scope', function($http, $scope) {
    $scope.cliente = {};
    
    $scope.clienteAdd = function() {
        if($scope.ClienteForm.$invalid) {
            if (!$("#cliente_nombre").hasClass("ng-valid")) {
                $("#cliente_nombre").addClass("ng-invalid ng-touched");
            }
            if (!$("#cliente_cif").hasClass("ng-valid")) {
                $("#cliente_cif").addClass("ng-invalid ng-touched");
            }
            if (!$("#cliente_direccion1").hasClass("ng-valid")) {
                $("#cliente_direccion1").addClass("ng-invalid ng-touched");
            }
            if (!$("#cliente_cp").hasClass("ng-valid")) {
                $("#cliente_cp").addClass("ng-invalid ng-touched");
            }
            if (!$("#cliente_ciudad").hasClass("ng-valid")) {
                $("#cliente_ciudad").addClass("ng-invalid ng-touched");
            }
            return false;
        }
        var cliente = angular.copy($scope.cliente);

        $scope.cliente = {};
        $scope.ClienteForm.$setUntouched();

        $http.put(apiurlcliente, cliente).success(function(data, status, headers, config) {
            cliente.id = data.id;
            $scope.clienteNuevoSelect(cliente);
            $scope.clienteNuevoCancelar();
        });
    };
}]);

appApp.controller("ConceptoFormController", ['$http', '$scope', function($http, $scope) {
    $scope.addConcepto = function() {
        if($scope.FormConcepto.$invalid) {
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

        $scope.concepto = {};
        $scope.FormConcepto.$setUntouched();

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

appApp.directive('contenteditable', function() {
  return {
    require: 'ngModel',
    link: function(scope, elm, attrs, ctrl) {
      // view -> model
      elm.on('blur', function() {
        scope.$apply(function() {
          ctrl.$setViewValue(elm.html());
        });
      });

      // model -> view
      ctrl.$render = function() {
        elm.html(ctrl.$viewValue);
      };

      // load init value from DOM
      ctrl.$setViewValue(elm.html());
    }
  };
});
