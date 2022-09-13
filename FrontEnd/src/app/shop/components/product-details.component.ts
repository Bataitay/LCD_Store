import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormBuilder } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { environment } from 'src/environments/environment';
import { Review } from '../shop';
import { ShopService } from '../shop.service';
declare var window: any;

@Component({
  selector: 'app-product-details',
  templateUrl: '../templates/product-details.component.html',
})
export class ProductDetailsComponent implements OnInit {

  product: any;
  url: string = environment.url;
  id: any;
  reviewForm !: FormGroup;
  review: any;
  constructor(private shopService: ShopService,
    private route: ActivatedRoute,
    private fb: FormBuilder,
    private _Router: Router,
    private toastrService: ToastrService,

  ) { }

  ngOnInit(): void {
    this.id = this.route.snapshot.params['id'];
    this.review = new window.bootstrap.Modal(
      document.getElementById('addReview')
    )
    this.shopService.product_detailSer(this.id).subscribe(res => {
      this.product = res;
    });
    this.reviewForm = this.fb.group({
      content: [''],
      vote: [''],
      customer_id: [''],
      product_id: this.id,
    });
  }
  openReview(id: any) {
    this.id = id;
    this.review.show();
  }
  addReview() {
    let review: Review = {
      content: this.reviewForm.value.content,
      vote: this.reviewForm.value.vote,
      customer_id: this.reviewForm.value.customer_id,
      product_id: this.id,
    }
    this.shopService.reviewSer(review).subscribe(res => {
      this.reviewForm.reset();
      this.review = res;
      if (this.review.status == true) {
        let ref = document.getElementById('cancel')
        ref?.click()
        this.toastrService.success(JSON.stringify(this.review.message))
      } else {
        this.toastrService.error(JSON.stringify(this.review.message))
      }
    })
  }

}
