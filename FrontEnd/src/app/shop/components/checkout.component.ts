import { Component, OnInit , ViewChild, ElementRef} from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { OrderService } from '../service/order.service';
import { render } from 'creditcardpayments/creditCardPayments';
// paypal.Buttons.driver("angular2", ng.core);
declare var paypal: any;
@Component({
    selector: 'app-checkout',
    templateUrl: '../templates/checkout.component.html',
})
export class CheckoutComponent implements OnInit {
    form!: FormGroup;

    listCart: any;
    cartSubtotal: number = 0;

    listProvince: any;
    listDistrict: any;
    listWard: any;

    provinceSelected: boolean = false;
    districtSelected: boolean = false;
    constructor(private orderService: OrderService, private _router: Router, private toastrService: ToastrService, ) {
        this.getAllCart();
    }

    ngOnInit(): void {
        this.form = new FormGroup({
            provinceId: new FormControl('', Validators.required),
            districtId: new FormControl('', Validators.required),
            wardId: new FormControl('', Validators.required),
            address: new FormControl('', Validators.required),
            note: new FormControl(''),
            name: new FormControl('', Validators.required),
            email: new FormControl('', [Validators.required, Validators.email]),
            phone: new FormControl('', Validators.required),
        })
        this.orderService.getAllProvince().subscribe(res => {
            this.listProvince = res;
        })
    }
    get f() {
        return this.form.controls;
    }
    getAllCart() {
        this.orderService.getAllCart().subscribe(res => {
            this.listCart = res;
            this.cartSubtotal = 0;
            for (let cart of this.listCart) {
                this.cartSubtotal += cart.price * cart.quantity;
            }
        });
    }
    onSelectProvince(event: any) {
        let provinceId = event.target.value;
        this.provinceSelected = true;
        this.districtSelected = false;
        this.orderService.getAllDistrictByProvinceId(provinceId).subscribe(res => {
            this.listDistrict = res;
        })
    }
    onSelectDistrict(event: any) {
        let districtId = event.target.value;
        this.districtSelected = true;
        this.orderService.getAllWardDistrictById(districtId).subscribe(res => {
            this.listWard = res;
        })
    }
    submit() {
        if(this.form.valid){
            this.orderService.storeOrder(this.form.value).subscribe(res => {
                this.getAllCart();
            });
            this._router.navigate(['product-list']);
            this.toastrService.success(JSON.stringify("Checkout Successfully"));
        }
    }
    pay(){
        render({
            id: "#paypalBtn",
            currency: "USD",
            value: this.cartSubtotal.toString(),
            onApprove: (details) => {
                alert('pay susseccfull');
            }
        })
    }
}
