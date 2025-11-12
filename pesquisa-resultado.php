import java.io.*;
import java.util.*;

public class Main {
    static class Cliente {
        private String nome;
        private String sobrenome;
        private String sexo;

        public Cliente(String nome, String sobrenome, String sexo) {
            this.nome = nome;
            this.sobrenome = sobrenome;
            this.sexo = sexo;
        }

        public String getNome() {
            return nome;
        }

        public String getSobrenome() {
            return sobrenome;
        }

        public String getSexo() {
            return sexo;
        }
    }

    private static final String FILE_PATH = "cadastro.txt";

    private static List<Cliente> searchBySexo(String sexo) {
        List<Cliente> result = new ArrayList<>();
        try (BufferedReader br = new BufferedReader(new FileReader(FILE_PATH))) {
            String line;
            while ((line = br.readLine()) != null) {
                String[] parts = line.split(",");
                if (parts.length == 3 && parts[2].trim().equalsIgnoreCase(sexo.trim())) {
                    Cliente c = new Cliente(parts[0].trim(), parts[1].trim(), parts[2].trim());
                    result.add(c);
                }
            }
        } catch (IOException e) {
            System.out.println("Erro ao ler arquivo: " + e.getMessage());
        }
        return result;
    }

    private static void addCliente(Cliente c) {
        try (BufferedWriter bw = new BufferedWriter(new FileWriter(FILE_PATH, true))) {
            bw.write(c.getNome() + "," + c.getSobrenome() + "," + c.getSexo());
            bw.newLine();
        } catch (IOException e) {
            System.out.println("Erro ao escrever arquivo: " + e.getMessage());
        }
    }

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        while (true) {
            System.out.println("1. Pesquisar por Sexo");
            System.out.println("2. Adicionar Cliente");
            System.out.println("3. Sair");
            System.out.print("Escolha uma opção: ");
            int opcao = scanner.nextInt();
            scanner.nextLine(); // Limpar buffer

            if (opcao == 1) {
                System.out.print("Digite o Sexo para pesquisa (M/F): ");
                String pesquisa = scanner.nextLine();
                List<Cliente> resultados = searchBySexo(pesquisa);
                System.out.println("NOME\tSOBRENOME\tSEXO");
                for (Cliente c : resultados) {
                    System.out.println(c.getNome() + "\t" + c.getSobrenome() + "\t" + c.getSexo());
                }
            } else if (opcao == 2) {
                System.out.print("Digite o Nome: ");
                String nome = scanner.nextLine();
                System.out.print("Digite o Sobrenome: ");
                String sobrenome = scanner.nextLine();
                System.out.print("Digite o Sexo (M/F): ");
                String sexo = scanner.nextLine();
                Cliente novo = new Cliente(nome, sobrenome, sexo);
                addCliente(novo);
                System.out.println("Cliente adicionado com sucesso!");
            } else if (opcao == 3) {
                break;
            } else {
                System.out.println("Opção inválida!");
            }
        }
        scanner.close();
    }
}
