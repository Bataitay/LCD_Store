import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ShopService } from '../shop.service';

@Component({
  selector: 'app-produt-list',
  templateUrl: '../templates/produt-list.component.html',
})
export class ProdutListComponent implements OnInit {

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
