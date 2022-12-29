class ToDoList:
    def __init__(self):
        self.head = None
    
    # Fungsi untuk menambahkan kegiatan baru ke daftar
    def add_task(self, task):
        new_node = ToDoNode(task)
        new_node.next = self.head
        self.head = new_node
    
    # Fungsi untuk mencetak semua kegiatan yang ada di daftar
    def print_tasks(self):
        current_node = self.head
        while current_node is not None:
            print(current_node.task)
            current_node = current_node.next

class ToDoNode:
    def __init__(self, task):
        self.task = task
        self.next = None

# Contoh penggunaan
list = ToDoList()
list.add_task("Mengerjakan Ujian Struktur Data")
list.print_tasks()
