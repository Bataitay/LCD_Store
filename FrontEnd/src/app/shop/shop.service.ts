import { Injectable } from '@angular/core';
import { Product } from './shop';
import { HttpClient,HttpErrorResponse  } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ShopService {
  product : Product[] =[];
  getAllProducts:string ='';
  constructor(private http: HttpClient,) {
    this.getAllProducts = environment.getAllProducts;
   }

  product_list():Observable<Product[]> {
    return this.http.get<Product[]>(this.getAllProducts);
  }
  product_detail(id:any):Observable<Product[]> {
    return this.http.get<Product[]>(environment.getIdProduct+'/'+id);
  }

}
