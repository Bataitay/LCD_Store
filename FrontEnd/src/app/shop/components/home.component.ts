import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { Product } from '../shop';
import { ShopService } from '../shop.service';

@Component({
  selector: 'app-home',
  templateUrl: '../templates/home.component.html',
})
export class HomeComponent implements OnInit {
  products: any[] =[];
  brands: any[] = []
  url: string = environment.url;

  constructor(private shopService: ShopService,
    private route: ActivatedRoute,
    private _Router: Router) { }

  ngOnInit(): void {
    this.trendingProduct();
    this.getAllBrand();

  }
  trendingProduct(){
    this.shopService.trendingProductSer().subscribe(res => {
      this.products = res;
    })
  }
  getAllBrand(){
    this.shopService.getAllBrand().subscribe(res => {
      this.brands = res;


  })
}

}
