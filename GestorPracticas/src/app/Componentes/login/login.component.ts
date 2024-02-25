import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { SessionService } from '../../service/session.service'; // Asegura que la ruta sea correcta
import { CrudService } from '../../service/crud.service'; // Asegura que la ruta sea correcta

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'], // Corrige 'styleUrl' a 'styleUrls'
})
export class LoginComponent {
  mensajeError: string = ''; // Recomendado usar tipos específicos
  usuario: string = ''; // Recomendado usar tipos específicos
  clave: string = ''; // Recomendado usar tipos específicos

  constructor(
    private crud: CrudService,
    private router: Router, 
    private sessionService: SessionService) {
      if (this.sessionService.estaLogueado()) {
        this.router.navigate(['/alumno-tabla-controller']); // Asegúrate que la ruta es la correcta
      }
    }
    login() {
      this.crud.create('login', {
        nom_alum: this.usuario,
        contra_alum: this.clave
      }).subscribe({
        next: (respuesta: any) => {
          if (respuesta.success) {
            this.sessionService.iniciarSesion(respuesta.data);
            this.router.navigate(['/alumno-tabla-controller']); // Asegúrate que la ruta es la correcta
          } else {
            // Usar window.alert() para mostrar el mensaje de error
            window.alert(respuesta.error || 'Usuario o clave incorrecta.');
          }
        },
        error: (error) => {
          console.error('Error durante el login:', error);
          // Puedes usar también window.alert() para mostrar errores inesperados
          window.alert('Error al intentar iniciar sesión. Por favor, inténtalo de nuevo.');
        }
      });
    }
    
  salir(){

  }
}
