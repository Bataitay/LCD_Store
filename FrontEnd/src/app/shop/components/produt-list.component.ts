import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { OrderService } from '../service/order.service';
import { ShopService } from '../shop.service';

@Component({
  selector: 'app-produt-list',
  templateUrl: '../templates/produt-list.component.html',
})
export class ProdutListComponent implements OnInit {

  products: any[] = [];
  url: string = environment.url;
  categories: any;
  category_id: any;
  quantity50_100: any;
  quantity100_500: any;
  quantity500_1000: any;
  quantity1000_5000: any;
  brands: any;
  brand_id: any;
  serachForm !: FormGroup;
  data: any;
  name: any;
  constructor(private shopService: ShopService,
    private route: ActivatedRoute,
    private _Router: Router,
    private orderService: OrderService,
    private fb: FormBuilder,

  ) { }

  ngOnInit(): void {
    this.product_list();
    this.filter1000_5000();
    this.shopService.category_listSer().subscribe(res => {
      this.categories = res;
    });
    this.shopService.getAllBrand().subscribe(res => {
      this.brands = res;
    });
    this.serachForm = this.fb.group({
      search: [''],
    })
    this.filterCate(this.category_id);
    this.filterBrand(this.brand_id);
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
      let obj = []
      for (const product of this.products) {
        if (product.price > 50 && product.price < 100) {
          obj.push(product);
          this.products = obj;
        }
      }
      this.quantity50_100 = obj;
    });

    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
      let obj = []
      for (const product of this.products) {
        if (product.price > 100 && product.price <= 500) {
          obj.push(product);
          this.products = obj;
        }
      }
      this.quantity100_500 = obj;
    })

    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
      let obj = []
      for (const product of this.products) {
        if (product.price > 500 && product.price <= 1000) {
          obj.push(product);
          this.products = obj;
        }
        this.quantity500_1000 = obj;
      }
    })

    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
      let obj = []
      for (const product of this.products) {
        if (product.price > 1000 && product.price <= 5000) {
          obj.push(product);
          this.products = obj;
        }
        this.quantity1000_5000 = obj;
      }
    })
  }

  product_list() {
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
    })
  }
  addToCart(id: number) {
    this.orderService.addToCart(id).subscribe(res => {
      this.orderService.getAllCart();
      alert('Added to cart');
    })
  }
  handdleSearch(search: any) {
    let keywork = this.serachForm.value.search
    this.shopService.searchProductList(keywork).then(res => {
      this.data = res;
      this.products = this.data
    })
  }
  filterCate(category_id: any) {
    this.category_id = category_id;
    this.shopService.category_listSer().subscribe(res => {
      this.categories = res;
      for (const category of this.categories) {
        if (this.category_id == category.id) {
          this.products = category.products;
        }
      }
    });
  }
  filterBrand(brand_id: any) {
    this.brand_id = brand_id;
    this.shopService.getAllBrand().subscribe(res => {
      this.brands = res;
      for (const brand of this.brands) {
        if (this.brand_id == brand.id) {
          this.products = brand.products;
        }
      }
    });
  }
  filter50_100() {
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
      let obj = []
      for (const product of this.products) {
        if (product.price >= 50 && product.price <= 100) {
          obj.push(product);
        }
      }
      this.products = obj;
    })
  }
  filter100_500() {
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
      let obj = []
      for (const product of this.products) {
        if (product.price > 100 && product.price <= 500) {
          obj.push(product);
        }
      }
      this.products = obj;
    })
  }
  filter500_1000() {
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
      let obj = []
      for (const product of this.products) {
        console.log(product.price);
        if (product.price >= 500 && product.price <= 1000) {
          obj.push(product);
        }
      }
      this.products = obj;
    })
  }
  filter1000_5000() {
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
      let obj = []
      for (const product of this.products) {
        if (product.price > 1000 && product.price <= 5000) {
          obj.push(product);
        }
      }
      this.products = obj;
    })
  }


}
