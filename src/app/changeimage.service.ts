import { Injectable, ViewChild } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ChangeimageService {

  imageName: string = "";
  images: string[] = ["assets/bannerImages/image1.png", "assets/bannerImages/image2.png", "assets/bannerImages/image3.png", "assets/bannerImages/image4.png"];
  x = -1;
  constructor() { }

  getNextImage() {
    this.x = (this.x === this.images.length - 1) ? 0 : this.x + 1;
    this.imageName = this.images[this.x];
    return this.imageName;
  }
}
