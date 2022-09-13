import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { ShopService } from '../shop.service';

@Component({
  selector: 'app-produt-list',
  templateUrl: '../templates/produt-list.component.html',
})
export class ProdutListComponent implements OnInit {

  products: any[] =[];
  url: string = environment.url;
  constructor(private shopService: ShopService,
    private route: ActivatedRoute,
    private _Router: Router,
    ) { }

  ngOnInit(): void {
    this.getAllPro();
  }

  public getAllPro(){
    this.shopService.product_list().subscribe(res => {
      this.products = res;
      // console.log(this.url+res[8]['image']);
    })
  }

}
