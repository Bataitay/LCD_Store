import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormBuilder } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { environment } from 'src/environments/environment';
import { AuthService } from '../auth.service';
import { Product, Review } from '../shop';
import { ShopService } from '../shop.service';
declare var window: any;
import * as moment from 'moment';
import { map, Observable, switchMap } from 'rxjs';
import { OrderService } from '../service/order.service';

@Component({
  selector: 'app-product-details',
  templateUrl: '../templates/product-details.component.html',
})
export class ProductDetailsComponent implements OnInit {

  url: string = environment.url;
  id: any;
  reviewForm !: FormGroup;
  answerForm !: FormGroup;
  review: any;
  currentUser: any;
  review_id: any;
  answer: any;
  customer_email: any;
  customer_id: any
  token: any;
  reviews: any;
  countStar: any;
  reviewStatus: any;
  avgRateStar: any;
  anserRe_id: any;
  now = moment();
  product:any;
  constructor(private shopService: ShopService,
    private _route: ActivatedRoute,
    private fb: FormBuilder,
    private _Router: Router,
    private toastrService: ToastrService,
    private authService: AuthService,
    private orderService: OrderService,
  ) {  }

  ngOnInit(): void {
    this.id = this._route.snapshot.params['id'];
    this.review = new window.bootstrap.Modal(
      document.getElementById('addReview')
    )
    this.answer = new window.bootstrap.Modal(
      document.getElementById('answer')
    )
    this.shopService.product_detailSer(this.id).subscribe(res => {
      this.product = res;
      for (let review of this.product.reviews) {
        review.vote = parseInt(review.vote)
        this.review_id = review.id;
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
    this.answerForm = this.fb.group({
      review_id: [''],
      name_answer: [''],
    });
    this.getCustomer();
    this.countReview();
    this.shopService.IdReview(this.anserRe_id).subscribe(res => {

    })
  }
  openReview(id: any) {
    this.id = id;
    this.review.show();
  }
  getCustomer() {
    this.shopService.getCustomer().subscribe(res => {
      this.customer_email = res;
      for (let customer of this.customer_email) {
        if (this.currentUser == customer.email) {

          this.customer_id = customer.id;
          continue;
        }
        this.reviews = res;
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
    this.shopService.reviewSer(this.token, review).subscribe(res => {
      this.reviewForm.reset();
      this.review = res;
      if (this.review.status == true) {
        const ref = document.getElementById('cancel')
        ref?.click()
        this.toastrService.success(JSON.stringify(this.review.message))
      } else {
        this.toastrService.error(JSON.stringify(this.review.message))
      }
    })
  }

  countReview() {
    this.shopService.countReview(this.id).subscribe(res => {
      this.countStar = res;
      this.avgRateStar = (((this.countStar.fiveStar * 5) + (this.countStar.fourStar * 4) + (this.countStar.threeStar * 3) + (this.countStar.twoStar * 2) + (this.countStar.oneStar * 1))
        / (this.countStar.fiveStar + this.countStar.fourStar + this.countStar.threeStar + this.countStar.twoStar + this.countStar.oneStar)).toFixed(2)
    });
  }
  openAnswer(review_id: any) {
    this.review_id = review_id;
    this.answer.show();
  }
  addAnswer() {
    let addAnswer = {
      name_answer: this.answerForm.value.name_answer,
      review_id: this.review_id,
      customer_id: this.customer_id,
    }
    this.shopService.answer(addAnswer).subscribe(res => {
      this.answerForm.reset();
      this.answer = res;
      if (this.answer.status == true) {
        const ref = document.getElementById('cancels')
        ref?.click()
        this.toastrService.success(JSON.stringify('Added answer successfully'))
      }
    })
  }
  addToCart(id: number){
    this.orderService.addToCart(id).subscribe(res => {
      this.orderService.getAllCart();
      alert('Added to cart');
    })
  }
}
