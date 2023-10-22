import { Component } from '@angular/core';
import { ChangeimageService } from '../changeimage.service';
import { interval } from 'rxjs';
@Component({
  selector: 'app-banner',
  templateUrl: './banner.component.html',
  styleUrls: ['./banner.component.css']
})
export class BannerComponent {
  imagen: string = "assets/bannerImages/image1.png";
  constructor(
    private changeimageService: ChangeimageService
  ) { }


  displayNextImage() {
    this.imagen = this.changeimageService.getNextImage();
  }

  myInterval = interval(3000).subscribe(() => {
    this.displayNextImage();
  });
}
