import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Product } from '../shop';
import { ShopService } from '../shop.service';

@Component({
  selector: 'app-home',
  templateUrl: '../templates/home.component.html',
})
export class HomeComponent implements OnInit {
  products: any[] =[]
  constructor(private shopService: ShopService,
    private route: ActivatedRoute,
    private _Router: Router) { }

  ngOnInit(): void {
    this.getAllPro();
  }

  public getAllPro(){
    this.shopService.getAllPro().subscribe(res => {
      this.products = res;
      console.log(this.products);
    })
  }
}
