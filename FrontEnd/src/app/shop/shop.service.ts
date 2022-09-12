import { Injectable } from '@angular/core';
import { Product } from './shop';
import { HttpClient,HttpErrorResponse  } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ShopService {
  product : Product[] =[];
  getAllProducts = 'http://127.0.0.1:8000/api/getProduct';
  constructor(private http: HttpClient,) { }

  getAllPro():Observable<Product[]> {
    return this.http.get<Product[]>(this.getAllProducts);
  }
}
