/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package com.Pagos.serveletsjh;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author axelz
 */
@WebServlet(name = "ProcesarPagoServlet", urlPatterns = {"/ProcesarPagoServlet"})
public class ProcesarPagoServlet extends HttpServlet {

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        // Lógica de procesamiento del pago
        String nombre = request.getParameter("nombre");
        String numeroTarjeta = request.getParameter("numeroTarjeta");
        String vencimiento = request.getParameter("vencimiento");
        String cvv = request.getParameter("cvv");

        // Simulación de validación de pago
        boolean pagoExitoso = simularPago(numeroTarjeta, vencimiento, cvv);

        // Respuesta al cliente
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        if (pagoExitoso) {
            out.println("<h2>Pago realizado con éxito</h2>");
            out.println("<p>Gracias por su compra, " + nombre + "!</p>");
        } else {
            out.println("<h2>Pago fallido</h2>");
            out.println("<p>Verifica los datos de tu tarjeta.</p>");
        }
    }

    // Simular la validación de un pago
    private boolean simularPago(String numeroTarjeta, String vencimiento, String cvv) {
        // Ejemplo básico de simulación de pago
        return numeroTarjeta.startsWith("4") && cvv.equals("123");
    }
}