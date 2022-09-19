import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { OrderService } from '../service/order.service';
import { environment } from 'src/environments/environment';
@Component({
  selector: 'app-order-detail',
  templateUrl: '../templates/order-detail.component.html',
})
export class OrderDetailComponent implements OnInit {
  orderId: any;
  order: any;
  totalPrice: number = 0;
  url: string = environment.url;
  constructor(
    private orderService: OrderService,
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.orderId = this.route.snapshot.params['id'];
    this.orderService.showOrder(this.orderId).subscribe(res => {
      this.order = res;
      console.log(this.order);
      for(let orderDetail of this.order.oder_details){
        this.totalPrice += parseInt(orderDetail.product_price) * parseInt(orderDetail.product_quantity);
      }
    })
  }

}
