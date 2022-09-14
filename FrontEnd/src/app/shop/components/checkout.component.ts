import { Component, OnInit } from '@angular/core';
import { ShopService } from '../shop.service';

@Component({
    selector: 'app-checkout',
    templateUrl: '../templates/checkout.component.html',
})
export class CheckoutComponent implements OnInit {
    listAddress: any;
    listProvince: any;
    listDistrict: any;
    listWard: any;
    provinceSelected: boolean = false;
    districtSelected: boolean = false;
    constructor(private shopService: ShopService) { }

    ngOnInit(): void {
        this.shopService.getAllProvince().subscribe(res => {
            this.listProvince = res;
        })
    }
    onSelectProvince(event: any){
        let provinceId = event.target.value;
        if(provinceId !== "0"){
            this.provinceSelected = true;
            this.districtSelected = false;
            this.shopService.getAllDistrictByProvinceId(provinceId).subscribe(res => {
                this.listDistrict = res;
            })
        }else{
            this.districtSelected = false;
            this.provinceSelected = false;
        }
    }
    onSelectDistrict(event: any){
        let districtId = event.target.value;
        if(districtId !== "0"){
            this.districtSelected = true;
            this.shopService.getAllWardDistrictById(districtId).subscribe(res => {
                this.listWard = res;
            })
        }else{
            this.districtSelected = false;
        }
    }
}
