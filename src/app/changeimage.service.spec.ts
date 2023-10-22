import { TestBed } from '@angular/core/testing';

import { ChangeimageService } from './changeimage.service';

describe('ChangeimageService', () => {
  let service: ChangeimageService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ChangeimageService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
