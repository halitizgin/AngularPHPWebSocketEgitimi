var app = angular.module('AngularPHP', []);
app.controller('AngularPHPController', ($scope, $http, $httpParamSerializerJQLike) => {
    $scope.movies = [];

    $scope.addName = "";
    $scope.addType = "";
    $scope.addYear = "";
    $scope.addImdb = "";

    $scope.willDeleteId = 0;
    $scope.willDeleteName = "";

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

    $scope.deleteMovie = () => {
        $http({
            method: 'DELETE',
            url: "api/api.php",
            data: $httpParamSerializerJQLike({
                id: $scope.willDeleteId
            }),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            }
        }).then(response => {
            const id = response.data.film_id;
            const index = $scope.movies.findIndex(movie => movie.film_id === id);
            if (index !== -1){
                $scope.movies.splice(index, 1);
            }
            $scope.willDeleteId = 0;
            $scope.willDeleteName = "";
        });
    }

    $scope.prepareDelete = (id, name) => {
        $scope.willDeleteId = id;
        $scope.willDeleteName = name;
    }
});