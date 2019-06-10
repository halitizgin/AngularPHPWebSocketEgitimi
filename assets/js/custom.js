var app = angular.module('AngularPHP', []);
app.controller('AngularPHPController', ($scope, $http) => {
    $scope.movies = [];

    $http({
        method: 'GET',
        url: "api/api.php"
    }).then(response => {
        $scope.movies = response.data;
    });
});