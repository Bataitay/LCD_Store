import { Injectable } from '@angular/core';
import { Category, Product, Register, Review } from './shop';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { catchError, Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ShopService {
  // product : Product[] =[];
  constructor(private http: HttpClient,) {

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
  reviewSer(review: Review): Observable<Review[]> {
    return this.http.post<Review[]>(environment.urlReview, review).pipe(
      catchError(this.handleError)
    );
  }
  registerSer(register: Register): Observable<Register[]> {
    return this.http.post<Register[]>(environment.urlRegister, register);
  }

}
