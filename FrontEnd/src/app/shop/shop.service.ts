import { Injectable } from '@angular/core';
import { Brand, Category, Product, Register, Review } from './shop';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { map, Observable, of } from 'rxjs';
import { environment } from 'src/environments/environment';
import { delay } from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})
export class ShopService {


  constructor(private http: HttpClient,) {}



  product_listSer(): Observable<Product[]> {
    return this.http.get<Product[]>(environment.urlAllProducts);
  }
  product_detailSer(id: any): Observable<Product[]> {
    return this.http.get<Product[]>(environment.urlIdProduct + '/' + id);
  }
  category_listSer(): Observable<Category[]> {
    return this.http.get<Category[]>(environment.urlAllCategories);
  }
  trendingProductSer(): Observable<Category[]> {
    return this.http.get<Category[]>(environment.urlTrendingPro);
  }
  getAllBrand(): Observable<Brand[]> {
    return this.http.get<Brand[]>(environment.urlGetAllBrand);
  }
  getAllBaner() {
    return this.http.get(environment.urlBaner);
  }
  googleLogin(): Observable<any> {
    return this.http.get<any[]>(environment.urlGoogleLogin)
  }
  registerSer(register: Register): Observable<Register[]> {
    return this.http.post<Register[]>(environment.urlRegister, register);
  }
  getCustomer(){
    return this.http.get(environment.urlCustomer);
  }
  reviewSer(token:any,review: Review): Observable<Review[]> {
    return this.http.post<Review[]>(environment.urlReview, review,{
      headers: new HttpHeaders().set('Authorization', `Bearer ${token}`)
    })
    .pipe(
      map((z) => {
        return z;
      })
    )
  }
  countReview(id:any){
    return this.http.get(environment.urlCountReview + '/' +id);
  }
  answer(data:any){
    return this.http.post(environment.urlanswer, data);
  }
  IdReview(id:any){
    return this.http.get(environment.urlIdReview + '/'+ id);
  }
  searchProductList(name:string){
    const response = new Promise(resolve => {
      this.http.get(environment.urlSearch+`product_list/search?
      search=${name}`).subscribe(data => {
        resolve(data)
      }, err => {
        console.log(err);
      });
    });
    return response;
  }

}
