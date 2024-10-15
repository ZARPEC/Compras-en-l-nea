/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */
package com.Pagos.servelets;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.*;
import java.util.logging.Level;
import java.util.logging.Logger;
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

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        // Recoger los datos del formulario
        String nombre = request.getParameter("nombre");
        String numeroTarjeta = request.getParameter("numeroTarjeta");
        String vencimiento = request.getParameter("vencimiento");
        String cvv = request.getParameter("cvv");
        Connection connection;

        // Preparar la respuesta al cliente
        response.setContentType("application/json");
        PrintWriter out = response.getWriter();
        boolean paymentStatus = false;  // Variable para indicar si el pago fue exitoso

        // Conectar a la base de datos y validar los detalles del pago
        try {
            Class.forName("oracle.jdbc.OracleDriver");
            String DB = "jdbc:oracle:thin:@localhost:1521/xe";
            connection = DriverManager.getConnection(DB, "tarjetas", "tarjetas");
            // Comprobar si la tarjeta existe con el CVV y la fecha de vencimiento
            String sql = "SELECT COUNT(*) FROM TARJETAS WHERE NUMERO_TARJETA = ? AND VENCIMIENTO = ? AND CVV = ?";
            PreparedStatement stmt = connection.prepareStatement(sql);
            stmt.setString(1, numeroTarjeta);
            stmt.setString(2, vencimiento);
            stmt.setString(3, cvv);
            ResultSet rs = stmt.executeQuery();

            // Ejecutar la consulta
            // Si hay una coincidencia en la base de datos, el pago es válido
            int count = 0;
            if (rs.next()) {
                count = rs.getInt(1);  // Obtener el valor de COUNT(*)
            }

            if (count > 0) {
                paymentStatus = true;  // El pago es válido

            } else {
                paymentStatus = false;  // El pago no es valido
            }
            out.println("{\"paymentStatus\": " + paymentStatus + "}");
        } catch (SQLException e) {
            e.printStackTrace();
            out.println("{\"paymentStatus\": false, \"error\": \"" + e.getMessage() + "\"}");
        } catch (ClassNotFoundException ex) {
            Logger.getLogger(ProcesarPagoServlet.class.getName()).log(Level.SEVERE, null, ex);
            out.println("{\"paymentStatus\": false, \"error\": \"" + ex.getMessage() + "\"}");
        }

    }

}
