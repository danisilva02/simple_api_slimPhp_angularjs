'use strict';

require('angular');
var MainController = require('./controllers/MainController');

var app = angular.module('app',[]);
app.controller('MainController',['$scope','$http',MainController]);
app.directive('uiAlert', require('./directive/alertDirective'));




