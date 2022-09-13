import { Component, OnInit } from '@angular/core';
import { ShopService } from '../shop.service';

@Component({
    selector: 'app-cart',
    templateUrl: '../templates/cart.component.html',
})
export class CartComponent implements OnInit {
    listCart: any;
    cartSubtotal: number = 0;
    constructor(private shopService: ShopService) { }

    ngOnInit(): void {
        this.getAllCart();
    }

    getAllCart() {
        this.shopService.getAllCart().subscribe(res => {
            this.listCart = res;
            this.cartSubtotal = 0;
            for(let cart of this.listCart){
                this.cartSubtotal += cart.price * cart.quantity;
            }
        });
    }
    updateQuantity(id: any, quantity: any){
        this.shopService.updateQuantity(id, quantity).subscribe(res => {
            this.getAllCart();
        });
    }
    deleteCart(id: any){
        this.shopService.deleteCart(id).subscribe(res => {
            this.getAllCart();
        });
    }
}
