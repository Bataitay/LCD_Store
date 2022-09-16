import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { OrderService } from '../service/order.service';
import { ShopService } from '../shop.service';

@Component({
  selector: 'app-produt-list',
  templateUrl: '../templates/produt-list.component.html',
})
export class ProdutListComponent implements OnInit {

  products: any[] =[];
  url: string = environment.url;
  categories: any;
  constructor(private shopService: ShopService,
    private route: ActivatedRoute,
    private _Router: Router,
    private orderService: OrderService,
    ) { }

  ngOnInit(): void {
    this.product_list();
    this.shopService.category_listSer().subscribe(res => {
      this.categories = res;
    });
  }

  public product_list(){
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
    })
  }
  addToCart(id: number){
    this.orderService.addToCart(id).subscribe(res => {
      this.orderService.getAllCart();
    })
  }

}
