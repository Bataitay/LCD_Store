import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ShopService } from '../shop.service';

@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  categories: any[] = []
  constructor(private shopService: ShopService,
    private route: ActivatedRoute,
  ) { }

  ngOnInit(): void {
    this.shopService.category_listSer().subscribe(res => {
      this.categories = res;
    });
  }
}
