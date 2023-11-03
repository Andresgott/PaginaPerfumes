import tkinter as tk
from tkinter import ttk
import mysql.connector

# Conectar a la base de datos
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="Erickita10",
    database="perfumeria"
)

# Crear un cursor
cursor = db.cursor()

# Consulta de ejemplo
cursor.execute("SELECT * FROM material")
result = cursor.fetchall()

window = tk.Tk()
window.title("Pagina de compra de insumos de proveedores")

# Obtener el ancho y alto de la pantalla
width = window.winfo_screenwidth()
height = window.winfo_screenheight()

# Calcular el punto medio de la pantalla
x = (width // 2) - (800 // 2)
y = (height // 2) - (600 // 2)

# Establecer el tamaño y la posición de la ventana
window.geometry(f'800x600+{x}+{y}')

# Crear un marco
canvas = tk.Canvas(window)
canvas.pack(side=tk.LEFT, fill=tk.BOTH, expand=True)

scrollbar = ttk.Scrollbar(window, orient=tk.VERTICAL, command=canvas.yview)
scrollbar.pack(side=tk.RIGHT, fill=tk.Y)

canvas.configure(yscrollcommand=scrollbar.set)
canvas.bind('<Configure>', lambda e: canvas.configure(scrollregion=canvas.bbox("all")))

frame = tk.Frame(canvas)
canvas.create_window((0, 0), window=frame, anchor="nw")


# Función para abrir una nueva ventana al hacer clic en el botón "Comprar"
def comprar_producto(nombre, Codigo_mat,precio_unit):
    cursor2 = db.cursor()
    cursor2.execute("SELECT * FROM matprov where Material_CodMat = %s", (Codigo_mat,))
    results_proveedores = cursor2.fetchall()

    print(results_proveedores,precio_unit)

    new_window = tk.Toplevel(window)
    new_window.title(f"Compra de producto {nombre}")

    
    label_title = tk.Label(new_window, text=f"Proveedores para el producto {nombre}", font=("Arial", 14, "bold"))
    label_title.grid(row=0, columnspan=3, padx=10, pady=5)

    headers = ["CodMat", "CodProv", "Nombre_prov","Cantidad"]
    for i, header in enumerate(headers):
        label_header = tk.Label(new_window, text=header, font=("Arial", 12, "bold"))
        label_header.grid(row=1, column=i, padx=10, pady=5)

    for i, row in enumerate(results_proveedores):
        for j, value in enumerate(row):
            label = tk.Label(new_window, text=value, font=("Arial", 12))
            label.grid(row=i + 2, column=j, padx=10, pady=5)
    
    entry_cantidad = tk.Entry(new_window, font=("Arial", 12))
    entry_cantidad.grid(row=i + 2, column=j + 1, padx=10, pady=5)

    result_label = tk.Label(new_window, text="", font=("Arial", 12))
    result_label.place(relx=0.5, rely=1.0, anchor="s")

    button_realizar_pedido = tk.Button(new_window, text="Realizar pedido", font=("Arial", 12),command=lambda cd=Codigo_mat:añadir(cd,entry_cantidad))
    button_realizar_pedido.place(relx=0.5, rely=0.75, anchor="s")

    button = tk.Button(new_window, text="Calcular precio", font=("Arial", 12), command=lambda: calcular_precio(entry_cantidad,precio_unit,result_label))
    button.grid(row=i + 2, column=j + 2, padx=10, pady=5)  


# Crear encabezados de columna
headers = ["CodMat", "Nombre", "Descripcion", "Cantidad","Precio unitario","Comprar"]
for i, header in enumerate(headers):
    label = tk.Label(frame, text=header, padx=10, pady=10, relief=tk.RIDGE)
    label.grid(row=0, column=i)

# Añadir un widget de etiqueta con los resultados de la consulta
for i, row in enumerate(result):
    for j, value in enumerate(row):
        label = tk.Label(frame, text=value, padx=10, pady=10, relief=tk.RIDGE)
        label.grid(row=i + 1, column=j)

    # Añadir botón en la última columna
    nombre_producto = row[1]  
    codigo_producto = row[0]
    precio_unit = row[4]
    button = tk.Button(frame, text="Comprar", padx=10, pady=5, command=lambda n=nombre_producto, c=codigo_producto,p=precio_unit: comprar_producto(n, c, p))
    button.grid(row=i + 1, column=j + 1)

# Configurar la cuadrícula para que esté centrada
for i in range(len(headers)):
    frame.grid_columnconfigure(i, weight=1)

for i in range(len(result) + 1):
    frame.grid_rowconfigure(i, weight=1)

update_button = tk.Button(window, text="Actualizar", font=("Arial", 12),command=lambda:actualizar())
update_button.place(relx=1, rely=0, anchor="ne")    

def calcular_precio(entry_cantidad, precio_unit, result_label):
    try:
        cantidad = int(entry_cantidad.get())
        precio_total = cantidad * precio_unit
        result_label.config(text=f"Precio Total: {precio_total:.2f}")
    except ValueError:
        result_label.config(text="Cantidad no válida")

def añadir(cod_mat,entry_cantidad):
    cantidad = int(entry_cantidad.get())
    cursor3 = db.cursor()
    cursor3.execute("UPDATE material SET Cantidad = Cantidad + %s WHERE CodMat = %s", (cantidad, cod_mat))
    db.commit()

def actualizar():
    db.commit()
    frame.destroy()
    frame = tk.Frame(canvas)
    canvas.create_window((0, 0), window=frame, anchor="nw")
    actualizar_datos()

def actualizar_datos():
    cursor.execute("SELECT * FROM material")
    new_result = cursor.fetchall()
    for i, row in enumerate(new_result):
        for j, value in enumerate(row):
            label = tk.Label(frame, text=value, padx=10, pady=10, relief=tk.RIDGE)
            label.grid(row=i + 1, column=j)


        

     


# Ejecutar el bucle principal
window.mainloop()
