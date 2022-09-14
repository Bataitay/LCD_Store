import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { AuthService } from '../auth.service';
import { User } from '../shop';
import { ShopService } from '../shop.service';
import jwt_decode from 'jwt-decode';
@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  categories: any[] = []
  currentUser :any;
  token:any;
  userData:any;
  constructor(private shopService: ShopService,
    private authService: AuthService,
    private route: ActivatedRoute,
  ) {
    this.authService.user.subscribe(user => {
      this.currentUser = user
      this.currentUser = this.currentUser.email
    }
      );
  }

  ngOnInit(): void {
    this.shopService.category_listSer().subscribe(res => {
      this.categories = res;
    });
    this.token = localStorage.getItem('token');
    this.userData = jwt_decode(this.token);
  }
  logout(){
    this.authService.logout();
  }
}
