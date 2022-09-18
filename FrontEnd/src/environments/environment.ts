// This file can be replaced during build by using the `fileReplacements` array.
// `ng build` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.
let urlApi = 'http://127.0.0.1:8000/api/';
export const environment = {
  production: false,
  url:'http://127.0.0.1:8000/',
  urlAllProducts : urlApi+'product_list',
  urlIdProduct : urlApi+'product_detail',
  urlAllCategories : urlApi+'category_list',
  urlTrendingPro : urlApi+'trendingProduct',
  urlReview : urlApi+'review',
  urlRegister : urlApi+'register',
  urlLogin : urlApi+'login',
  urlBaner : urlApi+'getBaner',
  urlCustomer : urlApi+'getCustomer',
  urlCountReview : urlApi+'coutReviewStar',
  urlGetAllBrand : urlApi+'brand',
  urlGoogleLogin : 'http://127.0.0.1:8000/auth/redirect/google',
  urlanswer : urlApi+'addAnswer',
  urlIdReview : urlApi+'addAnswer',
  urlSearch : urlApi,

};

/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import 'zone.js/plugins/zone-error';  // Included with Angular CLI.
