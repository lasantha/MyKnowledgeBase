var wpApp = new angular.module( 'wpAngularTheme', ['ui.router', 'ngResource'] );

wpApp.factory( 'Webs', function( $resource ) {
	return $resource( '/myweb/'+appInfo.api_url + 'web/:ID', {
		ID: '@id'
	})
});

wpApp.controller( 'ListCtrl', ['$scope', 'Webs', function( $scope, Webs ) {
	$scope.page_title = 'Blog Listing Page';

	Webs.query(function( res ) {
		$scope.webs = res;
	});
	
}]);

wpApp.controller( 'DetailCtrl', ['$scope', '$stateParams', 'Webs', function( $scope, $stateParams, Webs ) {
	Webs.get( { ID: $stateParams.id}, function(res){
		$scope.web = res;
	})
}])

wpApp.config( function( $stateProvider, $urlRouterProvider){
	$urlRouterProvider.otherwise('/');
	$stateProvider
		.state( 'list', {
			url: '/',
			controller: 'ListCtrl',
			templateUrl: appInfo.template_directory + 'templates/list.html'
		})
		.state( 'detail', {
			url: '/web/:id',
			controller: 'DetailCtrl',
			templateUrl: appInfo.template_directory + 'templates/detail.html'
		})
});

wpApp.filter( 'to_trusted', ['$sce', function( $sce ){
	return function( text ) {
		return $sce.trustAsHtml( text );
	}
}])



var myApp = angular.module('myApp', [
  'ngRoute',
  'artistControllers'
]);

myApp.config(['$routeProvider', function($routeProvider) {
  $routeProvider.
  when('/list', {
    templateUrl: appInfo.template_directory+'partials/list.html',
    controller: 'ListController'
  }).
  when('/details/:itemID',{
  	templateUrl:appInfo.template_directory+'partials/details.html',
  	controller: 'DetailsController'
  }).
  otherwise({
    redirectTo: '/list'
  });
}]);


var artistControllers = angular.module('artistControllers', []);

artistControllers.controller('ListController', ['$scope', '$http', function($scope, $http) {
  $http.get(ajax_url.ajaxurl, {params: { action: 'get_dets' }}).success(function(data) {
    $scope.artists = data;
    $scope.artistOrder = 'name';
    $scope.appPath =  appInfo.template_directory;
  });
}]);

artistControllers.controller('DetailsController', ['$scope', '$http', '$routeParams' ,function($scope, $http, $routeParams) {
  $http.get(ajax_url.ajaxurl, {params: { action: 'get_dets' ,id:$routeParams.itemID}}).success(function(data) {
    $scope.artists = data;
    // $scope.whichItem = $routeParams.itemID;
    $scope.appPath =  appInfo.template_directory;
  });
}]);
// var app = angular.module( 'myweb', [] );
// app.controller('wpposts', function($scope, $http) {
//     $http.get("/myweb/wp-json/wp/v2/web")
//     .then(function(response) {
//         $scope.webs = response.data;
//     });
// });
// app.config(function($routeProvider) {
//     $routeProvider
//     .when("/", {
//         templateUrl : appInfo.template_directory+"/inc/inc-posts.html"
//     })
//     .when("/red", {
//         templateUrl : "red.htm"
//     })
//     .when("/green", {
//         templateUrl : "green.htm"
//     })
//     .when("/blue", {
//         templateUrl : "blue.htm"
//     });
// });

$(document).ready(function() {
	$objProgressbar = $('.cv .progress .progress-bar');
	
	$.each($objProgressbar, function( index, value ) {
	  $valuenow = $(value).attr('aria-valuenow');
	  $(value).css('width',$valuenow+'%');
	});
	
	$('.docdownload').click(
		function(){
			$.ajax({
			  dataType: 'native',
			  url: $(this).attr('data'),
			  xhrFields: {
			    responseType: 'blob'
			  },
			  success: function(blob){
			      var link=document.createElement('a');
			      link.href=window.URL.createObjectURL(blob);
			      link.download="Dossier_" + new Date() + ".pdf";
			      link.click();
			  }
			});
		}
	);
	

});



