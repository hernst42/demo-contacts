/**
 * Created by apache on 6/16/15.
 */
'use strict';

/* Controllers */

var contactApp = angular.module('contactApp', []);

var filter = {
    Surname: '',
    FirstName: '',
    PLZ: '',
    City: '',
    asQueryString: function ()
    {
        var serializedFilter = '';
        if (this.Surname) {
            serializedFilter = serializedFilter + 'search[Surname]=' + encodeURI(filter.Surname) + '&';
        }
        if (this.FirstName) {
            serializedFilter = serializedFilter + 'search[Firstname]=' + encodeURI(filter.FirstName) + '&';
        }
        if (this.PLZ) {
            serializedFilter = serializedFilter + 'search[PLZ]=' + encodeURI(filter.PLZ) + '&';
        }
        if (this.City) {
            serializedFilter = serializedFilter + 'search[City]=' + encodeURI(filter.City) + '&';
        }
        return serializedFilter;
    }
};

contactApp.controller('ContactListCtrl', ['$scope', '$http', function ($scope, $http)
{
    $scope.toggle = function (active, id)
    {
        var url = 'service.php?' + filter.asQueryString() + (active == 'Y' ? 'disable' : 'enable') + '=' + id;
        $http.get(url).success(function (data)
        {
            $scope.contacts = data;
        });
    };
    $scope.update = function ()
    {
        $http.get('service.php?' + filter.asQueryString()).success(function (data)
        {
            $scope.contacts = data;
        });
    };
    $scope.$watch('SearchSurname', function (key)
    {
        filter.Surname = key;
        $scope.update();
    });
    $scope.$watch('SearchFirstname', function (key)
    {
        filter.FirstName = key;
        $scope.update();
    });
    $scope.$watch('SearchPLZ', function (key)
    {
        filter.PLZ = key;
        $scope.update();
    });
    $scope.$watch('SearchCity', function (key)
    {
        filter.City = key;
        $scope.update();
    });
    $scope.update();
}]);

