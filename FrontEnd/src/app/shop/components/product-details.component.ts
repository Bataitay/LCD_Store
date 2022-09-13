import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { ShopService } from '../shop.service';

@Component({
  selector: 'app-product-details',
  templateUrl: '../templates/product-details.component.html',
})
export class ProductDetailsComponent implements OnInit {

  product: any;
  url: string = environment.url;
  id:any;
  constructor(private shopService: ShopService,
    private route: ActivatedRoute,
    private _Router: Router,

    ) { }

  ngOnInit(): void {
    this.id = this.route.snapshot.params['id'];
    this.shopService.product_detailSer(this.id).subscribe(res => {
        this.product = res;
      })
  }

}
