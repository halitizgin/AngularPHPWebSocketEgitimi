var app = angular.module('AngularPHP', []);
app.controller('AngularPHPController', ($scope, $http, $httpParamSerializerJQLike) => {
    $scope.movies = [];

    $scope.addName = "";
    $scope.addType = "";
    $scope.addYear = "";
    $scope.addImdb = "";

    $http({
        method: 'GET',
        url: "api/api.php"
    }).then(response => {
        $scope.movies = response.data;
    });

    $scope.addMovie = () => {
        $http({
            method: 'POST',
            url: "api/api.php",
            data: $httpParamSerializerJQLike({
                name: $scope.addName,
                sort: $scope.addType,
                year: $scope.addYear,
                imdb: $scope.addImdb
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }).then(response => {
            const movie = response.data;
            $scope.movies.push(movie);
        });
    }
});