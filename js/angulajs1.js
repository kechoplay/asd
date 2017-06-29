var app = angular.module('app', []);
app.controller('ctrl1', function ($scope) {
    $scope.name = "hello world";
    $scope.number1 = 1;
    $scope.number2 = 1;

    $scope.human = [
        {city: 'hanoi', country: 'Vietnam', purchased: true},
        {city: 'paris', country: 'France', purchased: false},
        {city: 'roma', country: 'Itali', purchased: false}
    ];
    $scope.sum = function () {
        $scope.caculation = (+$scope.number1 + +$scope.number2);
    };

    $scope.opencart = function () {
        return $scope.srcUrl ? 'cart.php' : '';
    };
}).controller('ctrl2', function ($scope) {
    for (var i = 1; i <= $scope.fornumber; i++) {

    }
    $scope.clickchuot = function () {
        var result = [];
        for (var i = 1; i <= $scope.fornumber; i++) {
            result.push(i);
        }

        $scope.results = result;
        console.log(result);
    }

}).controller('ctrl3',function ($scope) {
    
});