import { Injectable } from '@angular/core';
import { Category, Product, Register, Review } from './shop';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { catchError, map, Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { AuthService } from './auth.service';
import { from } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class ShopService {
  constructor(private http: HttpClient,
    private authService: AuthService) {

  }
  private handleError(error: any): Promise<any> {
    console.error('An error occurred', error); // for demo purposes only
    return Promise.reject(error.message || error);
  }
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
  registerSer(register: Register): Observable<Register[]> {
    return this.http.post<Register[]>(environment.urlRegister, register);
  }
  getbaner(){
    return this.http.get(environment.urlBaner);
  }
  getCustomer(){
    return this.http.get(environment.urlCustomer);
  }
  countReview(id:any){
    return this.http.get(environment.urlCountReview + '/' +id);
  }

}
