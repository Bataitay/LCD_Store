import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { render } from 'creditcardpayments/creditCardPayments';
import { ToastrService } from 'ngx-toastr';
import { OrderService } from '../service/order.service';

@Component({
    selector: 'app-order-pay-online',
    templateUrl: '../templates/order-pay-online.component.html',
})
export class OrderPayOnlineComponent implements OnInit {
    orderId: any;
    order: any;
    totalPrice: number = 0;
    constructor(
        private orderService: OrderService,
        private route: ActivatedRoute,
        private router: Router,
        private toastrService: ToastrService
    ) { }

    ngOnInit(): void {
        this.orderId = this.route.snapshot.params['id'];
        this.orderService.showOrder(this.orderId).subscribe(res => {
            this.order = res;
            for (let orderDetail of this.order.oder_details) {
                this.totalPrice += parseInt(orderDetail.product_price) * parseInt(orderDetail.product_quantity);
            }
            render({
                id: "#paypalBtn",
                currency: "USD",
                value: this.totalPrice.toString(),
                onApprove: (details) => {
                    this.router.navigate(['order-detail', this.order.id]);
                    this.toastrService.success(JSON.stringify("Payment success"));
                }
            })
        });
    }

}
