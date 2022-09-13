// This file can be replaced during build by using the `fileReplacements` array.
// `ng build` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.

export const environment = {
  production: false,
  url:'http://127.0.0.1:8000/',
  urlAllProducts : 'http://127.0.0.1:8000/api/product_list',
  urlIdProduct : 'http://127.0.0.1:8000/api/product_detail',
  urlAllCategories : 'http://127.0.0.1:8000/api/category_list',
  urlTrendingPro : 'http://127.0.0.1:8000/api/trendingProduct',
  urlReview : 'http://127.0.0.1:8000/api/review',
  urlRegister : 'http://127.0.0.1:8000/api/register',

};

/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import 'zone.js/plugins/zone-error';  // Included with Angular CLI.
