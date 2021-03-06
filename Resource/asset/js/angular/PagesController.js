angular.module('Pages')
    .controller('PagesController', function(URL, page, $scope, $http, $location) {
        $scope.get = function(link) {
            $location.path(link).replace();

            link = URL + '/' + link;

            $http.get(link)
                .success(function (response) {
                    $scope.page = response.page;
                }
            );
        };

        $scope.delete = function() {

            if (confirm('Delete?')) {
                var link = URL + '/' + $scope.page.id;

                $http.delete(link)
                    .success(function () {
                        alert('Deleted successfully');
                    }
                );
            }
        };

        $scope.insert = function() {
            var slug = prompt("Slug");
            var title = prompt("Title");
            var body = prompt("Body");

            if (confirm('Add?')) {
                var link = URL;

                var params = {'slug': slug, 'title': title, 'body': body};
                $http.post(link, params)
                    .success(function () {
                        alert('Added successfully');
                    }
                );
            }
        };

        $scope.update = function() {
            var title = prompt("Title", $scope.page.title);
            var body = prompt("Body", $scope.page.body);

            if (confirm('Update?')) {
                var link = URL + '/' + $scope.page.id;

                var params = {'title': title, 'body': body};
                $http.put(link, params)
                    .success(function (response) {
                        $scope.page = response.page;
                        alert('Updated successfully');
                    }
                );
            }
        };

        // default action
        $scope.get(page);
    });
