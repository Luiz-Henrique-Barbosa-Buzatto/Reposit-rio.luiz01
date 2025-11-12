import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class Main {
    public static void main(String[] args) {
        // Dados do Banco de Dados a conectar
        String servidor = "localhost";
        String nomeBanco = "banco_teste";
        String usuario = "fabio";
        String senha = "123";
        
        // URL de conexão JDBC para MySQL (assumindo porta padrão 3306)
        String url = "jdbc:mysql://" + servidor + ":3306/" + nomeBanco;
        
        Connection conexao = null;
        Statement stmt = null;
        ResultSet rs = null;
        
        try {
            // Estabelece a conexão
            conexao = DriverManager.getConnection(url, usuario, senha);
            System.out.println("Conexão com o banco de dados estabelecida com sucesso!");
            
            // Complementando com uma consulta simples (assumindo uma tabela 'usuarios' com colunas 'id' e 'nome')
            stmt = conexao.createStatement();
            String sql = "SELECT * FROM usuarios"; // Substitua 'usuarios' pelo nome real da tabela
            rs = stmt.executeQuery(sql);
            
            // Processa e imprime os resultados
            while (rs.next()) {
                int id = rs.getInt("id");
                String nome = rs.getString("nome");
                System.out.println("ID: " + id + ", Nome: " + nome);
            }
        } catch (SQLException e) {
            System.out.println("Erro ao conectar ou consultar o banco de dados: " + e.getMessage());
        } finally {
            // Fecha os recursos
            try {
                if (rs != null) rs.close();
                if (stmt != null) stmt.close();
                if (conexao != null) conexao.close();
            } catch (SQLException e) {
                System.out.println("Erro ao fechar os recursos: " + e.getMessage());
            }
        }
    }
}
