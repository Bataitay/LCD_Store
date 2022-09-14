import { Injectable } from '@angular/core';
import { Category, Product } from './shop';
import { HttpClient,HttpErrorResponse  } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ShopService {
  // product : Product[] =[];
  constructor(private http: HttpClient,) {

   }

  product_listSer():Observable<Product[]> {
    return this.http.get<Product[]>(environment.urlAllProducts);
  }
  product_detailSer(id:any):Observable<Product[]> {
    return this.http.get<Product[]>(environment.urlIdProduct+'/'+id);
  }
  category_listSer():Observable<Category[]> {
    return this.http.get<Category[]>(environment.urlAllCategories);
  }
  trendingProductSer():Observable<Category[]> {
    return this.http.get<Category[]>(environment.urlTrendingPro);
  }
  addToCart(id: number){
    return this.http.get('http://127.0.0.1:8000/api/add-to-cart/'+id);
  }
  getAllCart(){
    return this.http.get('http://127.0.0.1:8000/api/list-cart');
  }
  updateQuantity(id: any, quantity: any){
    return this.http.get('http://127.0.0.1:8000/api/update-cart/'+id+'/'+quantity);
  }
  deleteCart(id: any){
    return this.http.get('http://127.0.0.1:8000/api/remove-to-cart/'+id);
  }
  createOrder(){
    return this.http.get(environment.url+'api/order/create');
  }
  getAllProvince(){
    return this.http.get(environment.url+'api/order/list-province');
  }
  getAllDistrictByProvinceId(id: any){
    return this.http.get(environment.url+'api/order/list-district/'+id);
  }
  getAllWardDistrictById(id: any){
    return this.http.get(environment.url+'api/order/list-ward/'+id);
  }
}
