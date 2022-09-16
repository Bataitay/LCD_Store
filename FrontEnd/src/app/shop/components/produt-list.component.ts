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
    this.product_list();
  }

  public product_list(){
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
    })
  }

}
