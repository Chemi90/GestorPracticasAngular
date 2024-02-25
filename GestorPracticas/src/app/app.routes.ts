import { Component } from '@angular/core';
import { Routes } from '@angular/router';
import { LoginComponent } from './Componentes/login/login.component';
import { AlumnoHomeControllerComponent } from './Componentes/alumno-home-controller/alumno-home-controller.component';
import { AlumnoTablaControllerComponent } from './Componentes/alumno-tabla-controller/alumno-tabla-controller.component';
import { Session } from 'inspector';
import { sessionGuard } from './guards/session.guard';

export const routes: Routes = [
    { path: 'login', component: LoginComponent },
    { path: 'alumno-home-controller', component: AlumnoHomeControllerComponent, canActivate: [sessionGuard]},
    { path: 'alumno-tabla-controller', component: AlumnoTablaControllerComponent, canActivate: [sessionGuard]},
    {path: '', redirectTo: 'login', pathMatch: 'full'},
    {path: '**', redirectTo: 'login', pathMatch: 'full'}

];
