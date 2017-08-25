import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
import { AppModule } from './app.module';
import { enableProdMode } from '@angular/core';


//only run production mode when the final project is finished
//enableProdMode();
const platform = platformBrowserDynamic();
platform.bootstrapModule(AppModule);