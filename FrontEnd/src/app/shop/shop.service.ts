import { Injectable } from '@angular/core';
import { Brand, Category, Product } from './shop';
import { HttpClient,HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ShopService {
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
  getAllBrand():Observable<Brand[]> {
    return this.http.get<Brand[]>(environment.urlGetAllBrand);
  }
}
