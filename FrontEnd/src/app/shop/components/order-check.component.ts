import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { OrderService } from '../service/order.service';

@Component({
    selector: 'app-order-check',
    templateUrl: '../templates/order-check.component.html',
})
export class OrderCheckComponent implements OnInit {
    form!: FormGroup;
    isEmptyOrder: boolean = false;
    constructor(
        private orderService: OrderService,
        private _router: Router
        ) { }

    ngOnInit(): void {
        this.form = new FormGroup({
            orderId: new FormControl('', Validators.required),
        })
    }
    get f() {
        return this.form.controls;
    }
    submit() {
        if (this.form.valid) {
            this.orderService.showOrder(this.form.value.orderId).subscribe(res => {
                if (Object.keys(res).length === 0 && res.constructor === Object) {
                    this.isEmptyOrder = true;
                }else{
                    this._router.navigate(['order-detail', this.form.value.orderId]);
                }
            })
        }
    }
}
