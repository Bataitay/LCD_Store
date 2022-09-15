import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormBuilder } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { environment } from 'src/environments/environment';
import { AuthService } from '../auth.service';
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
  currentUser:any;
  customer_email:any;
  customer_id:any
  token: any;
  reviews:any;
  countStar:any;
  reviewStatus:any;
  constructor(private shopService: ShopService,
    private route: ActivatedRoute,
    private fb: FormBuilder,
    private _Router: Router,
    private toastrService: ToastrService,
    private authService: AuthService,
  ) { }

  ngOnInit(): void {
    this.id = this.route.snapshot.params['id'];
    this.review = new window.bootstrap.Modal(
      document.getElementById('addReview')
    )
    this.shopService.product_detailSer(this.id).subscribe(res => {
      this.product = res;
      for (let review of this.product.reviews) {
        review.vote = parseInt(review.vote)
        // this.reviewStatus = review.status;
      }
    });
    this.authService.user.subscribe(user => {
      this.currentUser = user
      this.currentUser = this.currentUser.email;
      this.token = user;
      this.token = this.token.token.access_token;
    });
    this.reviewForm = this.fb.group({
      content: [''],
      vote: [''],
      customer_id: [''],
      product_id: this.id,
    });
    this.getCustomer();
    this.countReview();

  }
  openReview(id: any) {
    this.id = id;
    this.review.show();
  }
  getCustomer(){
    this.shopService.getCustomer().subscribe(res => {
      this.customer_email = res;
      for (let customer of this.customer_email) {
        if(this.currentUser == customer.email){

          this.customer_id = customer.id;
          continue;
        }
        this.reviews = res;
        // console.log(this.reviews.email);
        }
    })
  }
  addReview() {
    let review: Review = {
      content: this.reviewForm.value.content,
      vote: this.reviewForm.value.vote,
      customer_id: this.customer_id,
      product_id: this.id,
    }
    this.shopService.reviewSer(this.token,review).subscribe(res => {
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
  countReview(){
    this.shopService.countReview(this.id).subscribe(res => {
      this.countStar = res;
      // console.log(this.countStar);
    });
  }

}
