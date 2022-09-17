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
  categories:any;
  category_id: any;
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
    this.filter(this.category_id);
    this.filter50_100();
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
   filter(category_id:any){
    this.category_id = category_id;
    this.shopService.category_listSer().subscribe(res => {
      this.categories = res;
      for (const category of this.categories) {
        if(this.category_id == category.id){
        this.products = category.products;
        }
      }
    });
  }
  filter50_100(){
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
      console.log(this.products);
    })
  }
}
